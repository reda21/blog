// import store from "./../store"
// import StoreData from "../store/StoreData";
import test from "./axios"
import mockAxios from "axios"
jest.mock('axios');



it("addNotif", async  () => {
    let data = {
        data: {
            user: "reda21"
        }
    };
    mockAxios.get.mockImplementationOnce(() => Promise.resolve(data));
    console.log({test: await test("suiten")});
    expect(1).toBe(1);
});





