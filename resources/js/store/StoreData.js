import map from "lodash/map"
import difference from "lodash/difference"
import isEqual from "lodash/isEqual"
import Vue from "vue"

export default class StoreData {
    constructor(data = [], key = "id") {
        this.data = data;
        this.key = key;
    }

    syncro(data) {
        let self = this;

        // create list add and del items
        let mapsMessages = map(this.data, this.key);
        let mapsData = map(data, this.key);
        let del = difference(mapsMessages, mapsData);

        data.forEach(o => self.set(o));

        del.forEach(function (id) {
            self.delete(id);
        });

    }

    all() {
        return this.data;
    }

    count() {
        return this.data.length;
    }

    get(id, key = null) {
        let self = this;
        if (key)
            return this.data.find((o) => o[key] == id);
        return this.data.find((o) => o[self.key] == id);
    }

    set(value) {
        let self = this;
        let findIndex, findData;
        let id = value[this.key];
        findData = this.data.find((o, k) => {
            findIndex = k;
            return o[self.key] == id;
        });

        if (findData) {
            if (!isEqual(findData, value)) {
                Vue.set(self.data, findIndex, value);
                console.info('updated');
            } else {
                console.info('same');
            }
        } else {
            this.data.push(value);
            console.info('added');
        }
    }

    whereIn(id, key) {
        if (typeof id != "object") return false;
        let self = this;
        if (key)
            return this.data.filter((o) => id.includes(o[key]));
        return this.data.filter((o) => id.includes(o[self.key]));
    }

    delete(key) {
        if (typeof key == "object") {
            console.log("all")
            key.forEach(data => {
                this.delete(data)
            })
        } else {
            console.log("unit")
            let index = this.data.findIndex(function (o) {
                return o.id == key;
            });

            if (index > -1) {
                this.data.splice(index, 1);
                console.info('deleted');
            }
        }
    }

    first() {
        let length = this.data.length;
        if (length)
            return this.data[0];
        return null;
    }

    last() {
        let length = this.data.length;
        if (length)
            return this.data[length - 1];
        return null;
    }

    has(key) {
        return this.get(key) ? true : false;
    }

    deleteAll() {
        this.data.splice(0, this.data.length);
    }
}
