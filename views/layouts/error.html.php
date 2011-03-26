<!doctype html>
<html>
<head>
    <?php echo $this->html->charset(); ?>
    <title>Unhandled exception</title>
    <?php echo $this->html->style(array('debug', 'lithium')); ?>
    <?php echo $this->scripts(); ?>
    <?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="app">
    <div id="container">
        <div id="header">
            <h1>An unhandled exception was thrown</h1>
            <h3>Configuration</h3>
            <p>
                This layout can be changed by modifying
                <code><?php
                    echo realpath(LITHIUM_APP_PATH . '/views/layouts/error.html.php');
                ?></code>
            </p><p>
                To modify your error-handling configuration, see
                <code><?php
                    echo realpath(LITHIUM_APP_PATH . '/config/bootstrap/errors.php');
                ?></code>
            </p>
        </div>
        <div id="content">
            <?php echo $this->content(); ?>
        </div>
    </div>
</body>
</html>
