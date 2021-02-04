import axios from 'axios';

var UM = {
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
