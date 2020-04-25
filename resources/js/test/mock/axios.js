export default {
    get: jest.fn(() => Promise.resolve({
        data: {
            user: "reda21"
        }
    }))
}
