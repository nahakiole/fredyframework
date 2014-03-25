<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 11.02.14
 * Time: 18:37
 */

namespace View;

class View implements Viewable
{

    private $header;
    private $templateFile;
    private $variables;
    private $commandList;


    public function __construct($templateFile)
    {
        $this->commandList = array(
            'extend' => function ($arguments,$outputFile)
            {
                $arguments = split(' ',$arguments);

                $extendFile = $arguments[0];
                $containerName = $arguments[2];

                $newOutputFile = file_get_contents('View/Templates/index.html');

                var_dump($extendFile);
                echo '<br>';
                var_dump($containerName);


                $newOutputFile = preg_replace('/{ ?'.$containerName.' ?}/', $outputFile, $newOutputFile);

                return $newOutputFile;
            }
            );
        $this->templateFile = $templateFile;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function setVariables($variables)
    {
        if (!isset($this->variables)) {
            $this->variables = array();
        }
        $this->variables = array_merge($this->variables,$variables);
    }

    /**
     * Renders the view.
     */
    public function render()
    {
        $outputFile = file_get_contents($this->templateFile);
        if (isset($this->header)) {
            header($this->header);
        }
        // foreach ($this->templates as $templateName => $template) {
            // $templateFile = $template->render();
            // $outputFile = str_replace('{' . $templateName . '}', $templateFile, $outputFile);
        // }
        (preg_match_all('/\{\{ ?(?P<command>[\w]+)( (?P<arguments>(([\w]+|\'.*\') ?)*))? ?\}\}/', $outputFile, $commands));
        foreach ($commands['command'] as $key => $command) {
            if (array_key_exists($command, $this->commandList)) {
                $commandFunction = $this->commandList[$command];
                echo '<br>';
                echo '<br>';
                $outputFile = $commandFunction($commands['arguments'][$key],$outputFile);
            }
        }
        // $outputFile = preg_replace('/\{ ?[A-Z_]+ ?\}/', '', $outputFile);
        return $outputFile;
    }
} 