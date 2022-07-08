class Category {
    static get(params, then) {
        axios.get('/api/admin/blog/categories', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/admin/blog/categories').then(({data}) => {
            let elements = [];

            data.data.forEach(element => {
                elements.push({label: element.id, value: element.name});
            });

            then(elements);
        });
    }

    static show(element, then) {
        axios.get('/api/admin/blog/categories/' + element).then(({data}) => then(data.data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/blog/categories', data)
            .then(({data}) => then(data.data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/blog/categories/' + element, data)
            .then(({data}) => then(data.data))
            .catch(({response}) => error(response.data.errors));
    }

    static delete(element, then) {
        axios.delete('/api/admin/blog/categories/' + element)
            .then(({data}) => then(data.data));
    }
}

export default Category;