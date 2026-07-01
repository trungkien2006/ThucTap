import re

file_path = r'c:\Users\anima\Downloads\ThucTap-main\resources\views\events\show-template2.blade.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Extract styles
style_match = re.search(r'<style>(.*?)</style>', content, re.DOTALL)
styles = style_match.group(1) if style_match else ''
styles = styles.replace('body.gw-body', '.gw-wrapper')

# Extract main content (from HERO to before FOOTER)
content_match = re.search(r'(\{\{-- HERO --\}\}.*?)\{\{-- FOOTER --\}\}', content, re.DOTALL)
main_content = content_match.group(1) if content_match else ''
main_content = main_content.strip()

# Extract scripts
script_match = re.search(r'<script>(.*?)</script>', content, re.DOTALL)
scripts = script_match.group(1) if script_match else ''
# Remove nav and hamburger scripts
scripts = re.sub(r'// Nav scroll.*?// Gallery slider', '// Gallery slider', scripts, flags=re.DOTALL)

# Reassemble
new_content = f"""@extends('layouts.frontend')

@push('styles')
<style>
{styles}
</style>
@endpush

@section('content')
<div class="gw-wrapper">
{main_content}
</div>
@endsection

@push('scripts')
<script>
{scripts}
</script>
@endpush
"""

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(new_content)
print('Refactored show-template2.blade.php successfully!')
