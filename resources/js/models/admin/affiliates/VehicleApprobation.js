class VehicleApprobation {
    static store(element, then, error) {
        axios.post('/api/admin/affiliates/vehicles/' + element + '/approbations')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default VehicleApprobation;
