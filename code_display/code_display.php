<?php
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

class PlgContentCode_display extends CMSPlugin
{
    protected $app;

    public function onContentPrepare($context, &$article, &$params, $limit = 0)
    {
        // Load assets only once
        static $assetsLoaded = false;
        if (!$assetsLoaded)
        {
            $document = Factory::getDocument();

            // Include Prism CSS (Using the 'prism-tomorrow' theme)
            $document->addStyleSheet('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css');

            // Include Prism JS
            $document->addScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js');

            // Optionally include additional language components if needed
            // For example, to support PHP and JavaScript:
            $document->addScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js');
            $document->addScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js');

            // Include Clipboard.js
            $document->addScript('https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js');

            // Include custom JS
            $document->addScript(JUri::root() . 'plugins/content/code_display/assets/js/code_display.js');

            // Include custom CSS
            $document->addStyleSheet(JUri::root() . 'plugins/content/code_display/assets/css/code_display.css');

            $assetsLoaded = true;
        }

        // Use regex to find <pre><code> blocks
        // This regex accounts for possible additional attributes in the <code> tag
        $pattern = '#<pre\s*>(?:<code\s+class="([^"]+)">)?(.*?)</code></pre>#s';
        $replacement = function($matches) {
            $languageClass = isset($matches[1]) ? $matches[1] : 'language-none';
            $codeContent = htmlspecialchars_decode($matches[2]);

            // Generate unique ID for the code block
            $uniqueId = uniqid('code-block-');

            return '
                <div class="code-display-wrapper">
                    <pre><code id="' . $uniqueId . '" class="' . $languageClass . '">' . $codeContent . '</code></pre>
                    <button class="copy-button" data-clipboard-target="#' . $uniqueId . '">Copy</button>
                </div>
            ';
        };

        $article->text = preg_replace_callback($pattern, $replacement, $article->text);
    }
}
