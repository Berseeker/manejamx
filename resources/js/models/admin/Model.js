class Model {
    static get(params, then) {
        axios.get('/api/admin/models', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/models/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(params, then) {
        axios.get('/api/admin/models', {
            params: params
        }).then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, label: element.name, brand_id: element.brand_id});
            });

            then(elements);
        });
    }

    static store(data, then, error) {
        axios.post('/api/admin/models/', data)
             .then(({data}) => then(data))
             .catch(({response}) => error(response.data.errors));
    }
}

export default Model;
