class Client {
    static get(params, then) {
        axios.get('/api/admin/clients', {
            params: params
        })
            .then(({data}) => then(data));
    }
}

export default Client;
