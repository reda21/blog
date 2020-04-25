/**
 *
 * @type {exports}
 */
const puppeteer = require('puppeteer');

(async () => {

    const browser = await puppeteer.launch({devtools: true});
    const page = await browser.newPage();
    await page.setViewport({ width: 1280, height: 800 })
    let url = 'https://blog.me/';
    await page.goto(url);

    page.on('console', msg => console.log('PAGE LOG:', msg.text()));

    await page.evaluate(() => console.log(`url is ${location.href}`));

    const hrefElement = await page.$('a.btn.btn-lg.btn-block.btn-gb-login');
    
    await hrefElement.click();

    await page
        .screenshot({path: 'example.png'});
 //   await page.pdf({path: 'hn.pdf', format: 'A4'});


    // Get the "viewport" of the page, as reported by the page.
    const dimensions = await page.evaluate(() => {
        return {
            width: document.documentElement.clientWidth,
            height: document.documentElement.clientHeight,
            deviceScaleFactor: window.devicePixelRatio
        };
    });

    console.log('Dimensions:', dimensions);

    await browser.close();
})();
