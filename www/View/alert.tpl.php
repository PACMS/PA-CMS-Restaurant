<div id="alert-modal" class="alert-window">
    <div class="flex flex-column items-center justify-content-center w-64">
        <a href="#" id="alert-close" title="Close" class="alert-close">x</a>
            <?php echo '<h1 class="mb-8 text-' . $this->_alert . '-500 title">' . $this->_alert_title . '</h1>' . '<img class="mb-8 w-24 icon" src="../public/src/' . $this->_alert . '.png">' . $this->_alert_message ?>
    </div>
</div>