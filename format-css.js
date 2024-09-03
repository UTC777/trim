const fs = require('fs');
const path = require('path');
const glob = require('glob');

// Function to format CSS into a single line
function formatCss(filePath) {
    try {
        const css = fs.readFileSync(filePath, 'utf8');
        console.log(`Original content of ${filePath}:`, css); // Log original content

        const formattedCss = css
            .replace(/\s*{\s*/g, ' { ')
            .replace(/;\s*/g, '; ')
            .replace(/\s*}\s*/g, ' } ')
            .replace(/\n/g, ' ') // Replace newlines with space
            .replace(/\s+/g, ' ') // Collapse multiple spaces into one
            .trim();

        console.log(`Formatted content of ${filePath}:`, formattedCss); // Log formatted content
        fs.writeFileSync(filePath, formattedCss);
        console.log(`Formatted ${filePath}`);
    } catch (error) {
        console.error(`Error formatting ${filePath}:`, error);
    }
}

// Use glob to find CSS files and apply formatting
glob(path.join(__dirname, 'public/site/assets/css/*.css'), (err, files) => {
    if (err) {
        console.error('Error finding CSS files:', err);
        return;
    }

    console.log('Files found:', files); // Log the files found
    files.forEach(formatCss);
    console.log('CSS files formatted to single line.');
});
