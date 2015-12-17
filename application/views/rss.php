<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
    <channel>
        <title><?=$rss[0]['title']?></title>
        <link>http://<?echo gethostname() . "/" . $rss[0]['link']?>.rss</link>
        <description><?=$rss[0]['description']?></description>
        <?php foreach($rss_item as $item){ ?>
        <item>
            <title><?=$item['title']?></title>
            <link><?=$item['link']?></link>
            <description><?=$item['description']?></description>
            <pubDate><?=$item['date']?></pubDate>
            <enclosure url="http://<?echo gethostname() .  $item['img']?>"/>
        </item>
        <?php } ?>
    </channel>
</rss>