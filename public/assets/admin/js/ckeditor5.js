document.addEventListener('DOMContentLoaded', function() {
    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Underline,
        Strikethrough,
        Superscript,
        Subscript,
        Font,
        Paragraph,
        List,
        Indent,
        BlockQuote,
        Alignment,
        Link,
        // Image,
        Table,
        HorizontalLine,
        SpecialCharacters,
        FindAndReplace,
        Heading,
        FontSize,
        FontColor, 
        FontBackgroundColor,
        Clipboard
    } = CKEDITOR;

    const initEditor = (selector) => {
        ClassicEditor
            .create(document.querySelector(selector), {
                plugins: [
                    Essentials, Bold, Italic, Underline, Strikethrough, Superscript, Subscript, Font, Paragraph, List, Indent, BlockQuote, Alignment, Link, Table, HorizontalLine, SpecialCharacters, FindAndReplace, Heading, FontSize, FontColor, FontBackgroundColor
                ],
                toolbar: [
                    'undo', 'redo', '|',
                    // 'cut', 'copy', 'paste', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', '|',
                    // 'removeFormat', '|',
                    'numberedList', 'bulletedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', '|',
                    'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'link', 'insertTable', '|',
                    'horizontalLine', 'specialCharacters', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading',
                ],
                language: 'id',
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Normal', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' },
                    ],
                },
                fontSize: {
                    options: [8, 9, 11, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 40, 48, 60, 72]
                },
                fontFamily: {
                    options: ['default', 'Arial', 'Courier New', 'Helvetica', 'Lucida Sans Unicode', 'Georgia', 'Tahoma', 'Times New Roman', 'Verdana']
                },
            })
            .then(editor => {
                console.log('Editor initialized successfully', editor);
            })
            .catch(error => {
                console.error('There was a problem initializing the editor:', error);
            });
    };

    window.initEditor = initEditor;
});
