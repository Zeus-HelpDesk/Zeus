<template>
    <div>
        <textarea :id="id" :name="name" :class="classValue" :required="required" :autofocus="autofocus"></textarea>
    </div>
</template>

<script>
    import SimpleMDE from 'simplemde'
    import {Textcomplete} from 'textcomplete'

    export default {
        data() {
            return {}
        },
        props: {
            name: String,
            required: Boolean,
            autofocus: Boolean,
            classValue: String,
            id: String
        },
        created: function () {
            this.setupSimpleMDE()
        },
        methods: {
            setupSimpleMDE() {
                let docElement = null;
                if (this.name != null) {
                    docElement = document.getElementsByName(this.name)
                } else if (this.id != null) {
                    docElement = document.getElementById(this.id)
                }
                console.log(docElement);
                const simplemde = new SimpleMDE({
                    element: this,
                    forceSync: true,
                    toolbar: ["bold", "italic", "strikethrough", "|", "quote", "unordered-list", "ordered-list", "|", "link", "horizontal-rule", "|", "side-by-side", "preview", "fullscreen"],
                });
                const textcomplete = new Textcomplete(simplemde);
                textcomplete.register([{
                    // User match
                    match: /(^|\s)@(\w.+)$/,
                    search: function (term, callback) {
                        callback(term)
                    },
                    replace: function (value) {
                        return '@' + value;
                    }
                }, {
                    // Ticket match
                    match: /(^|\s)#(\w.+)$/,
                    search: function (term, callback) {
                        callback(term)
                    },
                    replace: function (value) {
                        return '#' + value;
                    }
                }, {
                    // KB Match
                    match: /(^|\s)!(\w.+)$/,
                    search: function (term, callback) {
                        callback(term)
                    },
                    replace: function (value) {
                        return '!' + value;
                    }
                }])

            }
        }
    }
</script>
