<div class="container">
    <h1>Sitemap</h1>
    <table id="sitemap" cellpadding="3">
        <thead>
            <tr>
                <th width="70%">URL</th>
                <th width="30%" title="Last Modification Time">Last Mod.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="<?php echo($protocol . '://' . $domain . '/login'); ?>"><?php echo($protocol . '://' . $domain . '/login'); ?></a></td>
                <td>2022-07-01 00:00:00</td>
            </tr>
            <tr>
                <td><a href="<?php echo($protocol . '://' . $domain . '/register'); ?>"><?php echo($protocol . '://' . $domain . '/register'); ?></a></td>
                <td>2022-07-01 00:00:00</td>
            </tr>
            <tr>
                <td><a href="<?php echo($protocol . '://' . $domain . '/lostPassword'); ?>"><?php echo($protocol . '://' . $domain . '/lostPassword'); ?></a></td>
                <td>2022-07-01 00:00:00</td>
            </tr>
            <?php foreach ($pages as $page) : ?>
            <tr>
                <td><a href="<?php echo($protocol . '://' . $domain . '/' . $page->url); ?>"><?php echo($protocol . '://' . $domain . '/' . $page->url); ?></a></td>
                <td><?php echo($page->updated_at); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>