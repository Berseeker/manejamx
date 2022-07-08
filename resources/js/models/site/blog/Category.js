class Category {
    static get(params, then) {
        axios.get('/api/blog/categories', {
            params: params
        })
            .then(({data}) => then(data));
    }

}

export default Category;