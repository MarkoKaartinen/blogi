<register-form inline-template>
    <modal name="register-form" height="auto">
        <div class="p-4">
            <form method="post" class="needs-validation" @submit.prevent="register">
                <div class="flex items-center justify-between">
                    <h2>Luo tunnus</h2>
                    <button class="btn btn-sm" @click="$modal.hide('login-form')">Sulje</button>
                </div>
                <div class="mb-4 mt-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="nickname">
                        Käyttäjänimi
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="nickname" id="nickname" type="text" placeholder="Käyttäjänimi" v-model="form.nickname" @keydown="errors.nickname = false" v-bind:class="{ 'border-danger': errors.nickname }" required autofocus>
                    <p class="text-danger text-xs italic mt-3" v-if="errors.nickname" v-text="errors.nickname[0]"></p>
                </div>
                <div class="mb-4 mt-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                        Sähköposti
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker{{ $errors->has('email') ? ' border-danger mb-3' : '' }}" name="email" id="email" type="email" placeholder="Sähköposti" v-model="form.email" @keydown="errors.email = false" v-bind:class="{ 'border-danger': errors.email }" required>
                    <p class="text-danger text-xs italic mt-3" v-if="errors.email" v-text="errors.email[0]"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                        Salasana
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker{{ $errors->has('password') ? ' border-danger mb-3' : '' }}" name="password" id="password" type="password" placeholder="Salasana" v-model="form.password" @keydown="errors.password = false" v-bind:class="{ 'border-danger': errors.password }" required>
                    <p class="text-danger text-xs italic mt-3" v-if="errors.password" v-text="errors.password[0]"></p>
                </div>
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password-confirm">
                        Toista salasana
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker{{ $errors->has('password') ? ' border-danger mb-3' : '' }}" name="password_confirmation" id="password-confirm" type="password" placeholder="Toista salasana" v-model="form.password_confirmation" @keydown="errors.password_confirmation = false" v-bind:class="{ 'border-danger': errors.password_confirmation }" required>
                    <p class="text-danger text-xs italic mt-3" v-if="errors.password_confirmation" v-text="errors.password_confirmation[0]"></p>
                </div>

                <div class="flex items-center justify-between">
                    <button class="btn" type="submit">
                        Luo tunnus
                    </button>
                </div>
            </form>
        </div>
    </modal>
</register-form>