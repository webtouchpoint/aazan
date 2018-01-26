<script>
    export default {
        data() {
            return {
                slug: 'tt',
                name: 'tt',
                url: ''
            }
        },
        methods: {
            deleteTag(slug, name) {
                this.slug = slug;
                this.name = name;
                this.url = '/admin/tags/' + slug;
                $("#modal-tag-delete").modal("show");
            }
        }
    }
</script>
