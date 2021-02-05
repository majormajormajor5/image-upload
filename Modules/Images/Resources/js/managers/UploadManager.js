import axios from 'axios';

var UM = {
    getAllUploadedImages: function(){
        return axios.get('/images/get-all-uploaded-images', JSON.stringify({}))
    },

    uploadFile: function(formData){
        return axios.post( '/images',
            formData,
            { headers: { 'Content-Type': 'multipart/form-data' } }
        );
    },
};

export function UploadManager() {
    return UM;
}
