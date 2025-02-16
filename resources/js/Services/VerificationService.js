import HttpApi from './HttpApi'

export default {
    async getVerificationStatus() {
        const response = await HttpApi.get('/profile/verification')
        return response.data
    },

    async updatePoints(points) {
        const response = await HttpApi.post('/profile/verification/points', { points })
        return response.data
    },

    async completeStep(step) {
        const response = await HttpApi.post('/profile/verification/complete-step', { step })
        return response.data
    }
} 