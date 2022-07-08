class Vehicle {
    static get(params, then) {
        axios.get('/api/admin/affiliates/vehicles', {
            params: params
        })
        .then(({data}) => then(data));
    }
}

export default Vehicle;
