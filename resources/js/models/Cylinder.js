class Cylinder {
    static get(params, then) {
        axios.get('/api/cylinders', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/cylinders', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/cylinders/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/cylinders/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(then) {
        axios.get('/api/cylinders').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, name: element.name});
            });

            then(elements);
        });
    }

}

export default Cylinder;
