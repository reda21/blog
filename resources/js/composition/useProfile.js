import {ref, computed, watch, onMounted} from "@vue/composition-api"
import jwt from "jsonwebtoken"
window.jwtx = jwt;
export function useProfile() {
    let token = jwt.sign({ foo: 'bar' }, 'shhhhh');

    const setUserProfil = () => {
        const secretKey = "mon_super_cle";
        const algorithms = {
            alg: ['HS256']
        };

        try {
            let result = jwt.verify(window.jwt, secretKey, algorithms);
            if (result)
                return result;
            return false


        } catch (err) {
            console.log(err.message);
            return false;
        }

    }

    const setAjustUserProfile = (User) => {
        return {
            id: User.user_id,
            username: User.user_username,
            url: User.user_url,
            role: User.user_role,
            role_description: User.user_role_description,
            first_name: User.user_first_name,
            last_name: User.user_last_name,
            avatar: User.avatar,
            ip: User.ip,
            agent: User.agent,
            online_show: User.online_show,
            token: User.token
        }
    };

    let profile = setUserProfil();

    profile = setAjustUserProfile(profile);

    return [profile];
}
