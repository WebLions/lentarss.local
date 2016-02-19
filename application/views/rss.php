<? header('Content-Type: application/xhtml+xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<rss version="2.0">
    <channel>
        <title><?=$rss->title?></title>
        <link>http://<? echo $_SERVER['SERVER_NAME'] . "/" . $rss->link?>.rss</link>
        <description><?=$rss->description?></description>
        <?php foreach($item as $it){
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $it['date'] );
            $date = $date->format('D, d M Y H:i:s P');
            ?><item>
            <title><![CDATA[ <?=$it['title']?> ]]></title>
            <link><![CDATA[ <?=$it['link'].$it['mobile']?> ]]></link>
            <pubDate><?=$date?></pubDate>
            <enclosure url="http://<? echo $_SERVER['SERVER_NAME'] .  $it['img']?>" type="image/jpeg"/>
            <source><![CDATA[ <?=$it['source']?> ]]></source>
        </item>
        <?php } ?>
    </channel>
</rss>