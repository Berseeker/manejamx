class Vehicle {
    static get(params, then) {
        axios.get('/api/vehicles', {
            params: params
        })
            .then(({data}) => then(data));
    }
    
    static show(element, then) {
        axios.get('/api/vehicles/'+element)
            .then(({data}) => then(data));
    }

    static storeQuoteRequest(element, data, then, error) {
        axios.post('/api/vehicles/'+element+'/quote-requests', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Vehicle;
