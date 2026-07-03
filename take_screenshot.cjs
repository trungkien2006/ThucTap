const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.setViewport({ width: 1200, height: 800 });
    
    // Go to the template preview URL
    await page.goto('http://localhost:8000/events/jobfair-2024', { waitUntil: 'networkidle2' });
    
    // Save screenshot
    await page.screenshot({ path: 'public/images/frontend/template-2-preview.jpg' });
    
    await browser.close();
    console.log('Screenshot saved!');
})();
