<?php include 'backend/Core.php';
    header('Content-type: application/xml');

    echo '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
?>        
        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/
            </loc>
            <changefreq>daily</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/genre.php
            </loc>
            <changefreq>monthly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/rating.php
            </loc>
            <changefreq>weekly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/popular.php
            </loc>
            <changefreq>weekly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/favorite.php
            </loc>
            <changefreq>weekly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/alphabet.php
            </loc>
            <changefreq>weekly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/released.php
            </loc>
            <changefreq>weekly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/random.php
            </loc>
            <changefreq>always</changefreq>
        </url>
        
        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/contact.php
            </loc>
            <changefreq>monthly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/about.php
            </loc>
            <changefreq>monthly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/dmca.php
            </loc>
            <changefreq>monthly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/terms.php
            </loc>
            <changefreq>monthly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/privacy.php
            </loc>
            <changefreq>monthly</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/rss.php
            </loc>
            <changefreq>daily</changefreq>
        </url>

        <url>
            <loc>
                <?php echo Core::getInstance()->homepath?>/sitemap.xml
            </loc>
            <changefreq>daily</changefreq>
        </url>

    </urlset>