class Affiliate {
    static store(data, then, error) {
        axios.post('/api/affiliates', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Affiliate;
