class Post {
    static get(params, then) {
        axios.get('/api/blog/posts', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static show(element, then) {
        axios.get('/api/blog/posts/' + element)
            .then(({data}) => then(data));
    }

}

export default Post;