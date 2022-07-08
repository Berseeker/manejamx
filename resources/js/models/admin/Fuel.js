class Fuel {
    static get(params, then) {
        axios.get('/api/admin/fuels', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/fuels', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/fuels/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/admin/fuels/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static restore(element, then, error) {
        axios.put('/api/admin/fuels/' + element+'/restorations')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(then) {
        axios.get('/api/admin/fuels').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, name: element.name});
            });

            then(elements);
        });
    }

}

export default Fuel;
