class Fuel {
    static get(params, then) {
        axios.get('/api/fuels', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/fuels', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/fuels/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/fuels/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(then) {
        axios.get('/api/fuels').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, name: element.name});
            });

            then(elements);
        });
    }

}

export default Fuel;
