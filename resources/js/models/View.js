class View {
    static store(element, then, error) {
        axios.post('/api/vehicles/'+element+'/views')
            .then(({data}) => then(data))
            .catch(({response}) => error(response));
    }
}

export default View;
