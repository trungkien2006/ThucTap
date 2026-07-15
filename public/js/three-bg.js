// 3D Isometric Interactive Grid using Three.js
document.addEventListener('DOMContentLoaded', function () {
    if (typeof THREE === 'undefined') return;

    const canvas = document.getElementById('three-bg-canvas');
    if (!canvas) return;

    // Scene setup
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xFFFBEA);

    // Perspective camera for top-down 2D view with depth
    const aspect = window.innerWidth / window.innerHeight;
    const camera = new THREE.PerspectiveCamera(45, aspect, 1, 1000);

    // Top-down 2D angle setup
    camera.position.set(0, 35, 0);
    camera.lookAt(0, 0, 0);

    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // Lights adjusted to prevent overexposing the eggshell color to white
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.55);
    scene.add(ambientLight);

    const dirLight = new THREE.DirectionalLight(0xffffff, 0.4);
    dirLight.position.set(10, 20, 10);
    scene.add(dirLight);

    const fillLight = new THREE.DirectionalLight(0xfff8d6, 0.2); // Warm golden fill
    fillLight.position.set(-10, 10, -10);
    scene.add(fillLight);

    // Grid Settings
    // Need a grid large enough to cover most screens. 
    // Since camera covers roughly 48x48 units, a 40x40 grid with cube size 1.5 should be huge.
    const gridSize = 45;
    const cubeSize = 1.3;
    const gap = 0.0; // Set gap to 0 to make it look like a solid background
    const offset = (gridSize * (cubeSize + gap)) / 2;

    const geometry = new THREE.BoxGeometry(cubeSize, cubeSize, cubeSize);

    // Eggshell material
    const material = new THREE.MeshLambertMaterial({
        color: 0xF0EAD6, // Eggshell color
        transparent: false
    });

    // InstancedMesh for performance
    const count = gridSize * gridSize;
    const mesh = new THREE.InstancedMesh(geometry, material, count);

    const dummy = new THREE.Object3D();
    const basePositions = [];
    const targetY = new Float32Array(count);

    let i = 0;
    for (let x = 0; x < gridSize; x++) {
        for (let z = 0; z < gridSize; z++) {
            const px = x * (cubeSize + gap) - offset;
            const pz = z * (cubeSize + gap) - offset;
            const py = 0;

            basePositions.push({ x: px, y: py, z: pz });
            targetY[i] = 0;

            dummy.position.set(px, py, pz);
            dummy.updateMatrix();
            mesh.setMatrixAt(i, dummy.matrix);

            i++;
        }
    }
    scene.add(mesh);

    // Raycasting for mouse hover
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2(9999, 9999);

    let targetX = 9999;
    let targetZ = 9999;

    window.addEventListener('mousemove', (event) => {
        mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

        raycaster.setFromCamera(mouse, camera);
        // Intersect a mathematical plane at y=0
        const plane = new THREE.Plane(new THREE.Vector3(0, 1, 0), 0);
        const target = new THREE.Vector3();
        raycaster.ray.intersectPlane(plane, target);

        if (target) {
            targetX = target.x;
            targetZ = target.z;
        }
    });

    // Resize handler
    window.addEventListener('resize', () => {
        const aspect = window.innerWidth / window.innerHeight;
        camera.aspect = aspect;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });

    // Animation Loop
    const clock = new THREE.Clock();
    const waveRadius = 4.5;
    const waveHeight = 3.0; // Increased by 30% from 2.0

    const pulses = [];
    window.addEventListener('click', () => {
        if (targetX !== 9999) {
            pulses.push({
                x: targetX,
                z: targetZ,
                startTime: clock.getElapsedTime()
            });
        }
    });

    function animate() {
        requestAnimationFrame(animate);
        const time = clock.getElapsedTime();

        // Remove old pulses that have faded out
        for (let p = pulses.length - 1; p >= 0; p--) {
            if (time - pulses[p].startTime > 4.0) {
                pulses.splice(p, 1);
            }
        }

        let idx = 0;
        for (let x = 0; x < gridSize; x++) {
            for (let z = 0; z < gridSize; z++) {
                const pos = basePositions[idx];

                // Base gentle floating wave (perpetual motion)
                let y = 0; // Removed auto wave

                // Mouse hover wave effect
                const dist = Math.sqrt(Math.pow(pos.x - targetX, 2) + Math.pow(pos.z - targetZ, 2));

                if (dist < waveRadius) {
                    // Smooth falloff curve
                    const influence = 1 - (dist / waveRadius);
                    y += Math.sin(influence * (Math.PI / 2)) * waveHeight;
                }

                // Pulse effects from clicks
                for (let p = 0; p < pulses.length; p++) {
                    const pulse = pulses[p];
                    const age = time - pulse.startTime;
                    const pulseRadius = age * 12.0; // Pulse expansion speed

                    const distToPulse = Math.sqrt(Math.pow(pos.x - pulse.x, 2) + Math.pow(pos.z - pulse.z, 2));
                    const distanceToWaveFront = Math.abs(distToPulse - pulseRadius);
                    const pulseWidth = 2.5;

                    if (distanceToWaveFront < pulseWidth) {
                        // Strength decays with age
                        const decay = Math.max(0, 1 - (age / 4.0));
                        const waveShape = Math.cos((distanceToWaveFront / pulseWidth) * (Math.PI / 2));
                        
                        y += waveShape * 2.0 * decay; // 2.0 is max pulse height
                    }
                }

                // Smooth interpolation for the Y position to avoid jittering
                targetY[idx] += (y - targetY[idx]) * 0.1;

                dummy.position.set(pos.x, targetY[idx], pos.z);

                // Add a slight rotation based on height to make it feel organic
                dummy.rotation.x = targetY[idx] * 0.05;
                dummy.rotation.z = targetY[idx] * 0.05;

                dummy.updateMatrix();
                mesh.setMatrixAt(idx, dummy.matrix);

                idx++;
            }
        }

        mesh.instanceMatrix.needsUpdate = true;
        renderer.render(scene, camera);
    }

    animate();
});
