<?php
/**
 * First, import the relevant Lithium core classes.
 */
use lithium\core\ErrorHandler;
use lithium\core\Environment;
use lithium\action\Response;
use lithium\net\http\Media;
use lithium\analysis\Logger;
use lithium\analysis\Debugger;
use lithium\analysis\Inspector;


/**
 * Then, set up a basic logging configuration that will write to a file.
 */
Logger::config(array(
    'error' => array(
        'adapter' => 'File'
    ),
));

/**
 * Error handling for twig templates. The same code is not used on every template because the
 * lithium templates can contain view related php code (like the ini_set-s)
 */
ErrorHandler::apply('lithium\action\Dispatcher::run', array(), function($info, $params) {
    if ($params['request']->type() != "html") return;
    $response = new Response(array('request' => $params['request']));

    ini_set('highlight.string', '#4DDB4A');
    ini_set('highlight.comment', '#D42AAE');
    ini_set('highlight.keyword', '#D42AAE');
    ini_set('highlight.default', '#3C96FF');
    ini_set('highlight.htm', '#FFFFFF');

    $exception = $info['exception'];
    $replace = array('&lt;?php', '?&gt;', '<code>', '</code>', "\n");
    $context = 5;

    $stack = Debugger::trace(array('format' => 'array', 'trace' => $exception->getTrace()));

    array_unshift($stack, array(
        'functionRef' => '[exception]',
        'file' => $exception->getFile(),
        'line' => $exception->getLine()
    ));

    foreach ($stack as &$frame)
    {
        $location = "{$frame['file']}: {$frame['line']}";
        $lines = range($frame['line'] - $context, $frame['line'] + $context);
        $code = Inspector::lines($frame['file'], $lines);
        if ($code)
        {
            foreach ($code as $num => &$content)
            {
                $numPad = str_pad($num, 3, ' ');
                $content = str_ireplace(array('<?php', '?>'), '', $content);
                $content = highlight_string("<?php {$numPad}{$content} ?>", true);
                $content = str_replace($replace, '', $content);
            }
        }
        $frame += compact('location', 'lines', 'code');
    }


    $code = $exception->getCode();
    $class = get_class($exception);
    $message = $exception->getMessage();

    $data = compact('info', 'params', 'class', 'stack', 'code', 'exception');


    Media::render($response, $data, array(
        'controller' => '_errors',
        'type' => 'html',
        'template' => 'development',
        'layout' => 'error',
        'request' => $params['request']
    ));
    return $response;
});

/**
 * If you use regular lithium templates you should use this handler as the view
 * itself contains all the formatting setup that is taken care of here for
 * twig templates
 */
/*
ErrorHandler::apply('lithium\action\Dispatcher::run', array(), function($info, $params) {
    $response = new Response(array('request' => $params['request']));

    Media::render($response, compact('info', 'params'), array(
        'controller' => '_errors',
        'template' => 'development',
        'layout' => 'error',
        'request' => $params['request']
    ));
    return $response;
});
*/
