class Approbation {
    static store(element, then, error) {
        axios.post('/api/admin/affiliates/' + element + '/approbations')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Approbation;
