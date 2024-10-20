# The Project
I use Joomla for website development and I want to display code (python, php, etc.) with syntax highlighting on a joomla page/article. I want the code to be displayed like this: 

![python-code](https://github.com/user-attachments/assets/8c653cb7-941a-45c3-93f6-fb7973bfeba1)


## Joomla 5 plugin to display code snippets

### Overview
1. **Plugin Type**: We'll create a Content Plugin that processes content to identify code blocks and enhance them with syntax highlighting and a copy button.
2. **Libraries Used**:
     - **Prism.js**: For syntax highlighting.
     - **Clipboard.js**: For handling the copy functionality.
3.  **Plugin Structure**:
      - **Manifest File** (code_display.xml): Defines the plugin metadata.
      - **PHP Plugin File** (code_display.php): Handles the processing of content.
      - **Assets**: CSS and JS files for styling and functionality.
