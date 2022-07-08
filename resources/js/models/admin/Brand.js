class Brand {
    static get(params, then) {
        axios.get('/api/admin/brands', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static update(element, data, then, error) {
        axios.post('/api/admin/brands/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(params, then) {
        axios.get('/api/admin/brands', {
            params: params
        }).then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, label: element.name});
            });

            then(elements);
        });
    }

    static store(data, then, error) {
        axios.post('/api/admin/brands/', data)
             .then(({data}) => then(data))
             .catch(({response}) => error(response.data.errors));
    }

}

export default Brand;
