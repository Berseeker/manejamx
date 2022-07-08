class VehicleRejection {
    static store(element, then, error) {
        axios.post('/api/admin/affiliates/vehicles/' + element + '/rejections')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default VehicleRejection;
