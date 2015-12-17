<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
    <channel>
        <title><?=$rss[0]['title']?></title>
        <link><?=$rss[0]['link']?></link>
        <description><?=$rss[0]['description']?></description>
        <?php foreach($rss_item as $item){ ?>
        <item>
            <title><?=$item['title']?></title>
            <link><?=$item['link']?></link>
            <description><?=$item['description']?></description>
            <pubDate><?=$item['date']?></pubDate>
            <enclosure url="<?=$item['img']?>"/>
        </item>
        <?php } ?>
    </channel>
</rss>