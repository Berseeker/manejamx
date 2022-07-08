class Vehicle {
    static get(then, error) {
        axios.get('/api/site/affiliates/vehicles')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static store(data, then, error) {
        axios.post('/api/site/affiliates/vehicles', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Vehicle;
