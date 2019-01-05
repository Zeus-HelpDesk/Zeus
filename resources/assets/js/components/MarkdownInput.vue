<template>
    <div class="markdown-editor">
        <textarea :name="boxName" :id="boxId"></textarea>
    </div>
</template>

<script>
    import SimpleMDE from 'simplemde';
    import marked from 'marked';
    import {Textcomplete} from 'textcomplete';
    import CodeMirrorEditor from 'textcomplete.codemirror';

    export default {
        name: 'markdown-input',
        props: {
            value: String,
            previewClass: String,
            autoinit: {
                type: Boolean,
                default() {
                    return true;
                },
            },
            highlight: {
                type: Boolean,
                default() {
                    return false;
                },
            },
            sanitize: {
                type: Boolean,
                default() {
                    return true;
                },
            },
            boxName: {
                type: String,
                default() {
                    return '';
                }
            },
            boxId: {
                type: String,
                default() {
                    return '';
                }
            },
            configs: {
                type: Object,
                default() {
                    return {};
                },
            },
        },
        mounted() {
            if (this.autoinit) this.initialize();
        },
        activated() {
            const editor = this.simplemde;
            if (!editor) return;
            const isActive = editor.isSideBySideActive() || editor.isPreviewActive();
            if (isActive) editor.toggleFullScreen();
        },
        methods: {
            initialize() {
                const configs = Object.assign({
                    element: this.$el.firstElementChild,
                    initialValue: this.value,
                    renderingConfig: {},
                    toolbar: ["bold", "italic", "strikethrough", "|", "quote", "unordered-list", "ordered-list", "|", "link", "horizontal-rule", "|", "side-by-side", "preview", "fullscreen",],
                }, this.configs);

                // Initial Input
                if (configs.initialValue) {
                    this.$emit('input', configs.initialValue);
                }

                // Should we highlight code
                if (this.highlight) {
                    configs.renderingConfig.codeSyntaxHighlighting = true;
                }

                // sanitize html?
                marked.setOptions({sanitize: this.sanitize});

                // Set simplemde
                this.simplemde = new SimpleMDE(configs);

                const textEditor = new CodeMirrorEditor(this.simplemde.codemirror);
                const textcomplete = new Textcomplete(textEditor);
                let emoji = {};
                axios.get('/api/emoji').then(response => {
                    emoji = response.data;
                });
                textcomplete.register([{
                    match: /(^|\s):([a-z0-9+\-_]*)$/,
                    search: function (term, callback) {
                        callback(Object.keys(emoji).filter(name => {
                            return name.startsWith(term);
                        }))
                    },
                    template: function (name) {
                        return '<img class="emoji" src=' + emoji[name]["img"] + '>  ' + name;
                    },
                    replace: function (value) {
                        return ' :' + value + ':';
                    }
                }, {
                    // Ticket match
                    match: /(^|\s)#(\w.+)$/,
                    search: function (term, callback) {
                        console.log(term);
                        // TODO: Finish this callback
                        callback(function () {
                            return ['AABBCCDD', 'ACFG1345A']
                        })
                    },
                    replace: function (value) {
                        return '#' + value;
                    }
                }, {
                    // KB Match
                    match: /(^|\s)!(\w.+)$/,
                    search: function (term, callback) {
                        // TODO: Finish this callback
                        callback(function () {
                            return ['AAVVGGHH', 'TEST1234']
                        })
                    },
                    replace: function (value) {
                        return '!' + value;
                    }
                }]);

                // set previewClass
                const className = this.previewClass || '';
                this.addPreviewClass(className);
                this.bindingEvents();
            },
            bindingEvents() {
                this.simplemde.codemirror.on('change', () => {
                    this.$emit('input', this.simplemde.value());
                });
            },
            addPreviewClass(className) {
                const wrapper = this.simplemde.codemirror.getWrapperElement();
                const preview = document.createElement('div');
                wrapper.nextSibling.className += ` ${className}`;
                preview.className = `editor-preview ${className}`;
                wrapper.appendChild(preview);
            },
        },
        destroyed() {
            this.simplemde = null;
        },
        watch: {
            value(val) {
                if (val === this.simplemde.value()) return;
                this.simplemde.value(val);
            },
        },
    };
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';

    .markdown-editor .markdown-body {
        padding: 0.5em
    }

    .markdown-editor .editor-preview-active, .markdown-editor .editor-preview-active-side {
        display: block;
    }
</style>
