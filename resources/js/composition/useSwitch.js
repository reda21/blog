import {ref, computed, watch, onMounted} from "@vue/composition-api"

export function useSwitch() {
    const Switch = ref(false);

    onMounted(() => {
        Switch.value = localStorage.getItem("darkSwitch") == "true" ? true : false;
    });

    //function
    const changeAttribute = (val) => {
        if (val) {
            document.body.setAttribute("data-theme", "dark");
        } else {
            document.body.removeAttribute("data-theme");
        }
    };

    // Watchers
    watch(Switch, (newVal, oldVal) => {
        localStorage.setItem("darkSwitch", newVal)
        changeAttribute(newVal);
    });

    const beta = ref("real madrid");

    return [Switch];
}
