document.addEventListener('DOMContentLoaded', function () {
    // Initialize Clipboard.js
    var clipboard = new ClipboardJS('.copy-button', {
        text: function(trigger) {
            var target = trigger.getAttribute('data-clipboard-target');
            var codeElement = document.querySelector(target);
            return codeElement ? codeElement.innerText : '';
        }
    });

    clipboard.on('success', function(e) {
        e.trigger.textContent = 'Copied!';
        setTimeout(function() {
            e.trigger.textContent = 'Copy';
        }, 2000);
    });

    clipboard.on('error', function(e) {
        e.trigger.textContent = 'Error';
        setTimeout(function() {
            e.trigger.textContent = 'Copy';
        }, 2000);
    });

    // Initialize Prism syntax highlighting
    if (typeof Prism !== 'undefined') {
        Prism.highlightAll();
    } else {
        console.error('Prism.js is not loaded.');
    }
});
