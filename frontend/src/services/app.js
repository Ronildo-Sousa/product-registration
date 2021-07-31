import { http } from "./config";

export default {
    getHome: () => {
        return http.get('api')
    }
}