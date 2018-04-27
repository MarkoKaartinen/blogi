<login-form inline-template>
    <modal name="login-form" height="auto">
        <div class="p-4">
            <form method="post" class="needs-validation" @submit.prevent="login">
                <div class="flex items-center justify-between">
                    <h2>Kirjaudu</h2>
                    <button class="btn btn-sm" @click="$modal.hide('login-form')">Sulje</button>
                </div>
                <div class="mb-4 mt-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                        Sähköposti
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="email" id="email" type="email" placeholder="Sähköposti" v-model="form.email" @keydown="errors.email = false" v-bind:class="{ 'border-danger': errors.email }" required autofocus>
                    <p class="text-danger text-xs italic mt-3" v-if="errors.email" v-text="errors.email[0]"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                        Salasana
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="password" id="password" type="password" placeholder="Salasana" v-model="form.password" @keydown="errors.password = false" v-bind:class="{ 'border-danger': errors.password }" required>
                    <p class="text-danger text-xs italic mt-3" v-if="errors.password" v-text="errors.password[0]"></p>
                </div>
                <div class="mb-6">
                    <label class="cursor-pointer">
                        <input type="checkbox" name="remember" v-model="form.remember"> Muista minut
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <button class="btn" type="submit">
                        Kirjaudu
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm no-underline text-link hover:text-link-dark" href="{{ route('password.request') }}">
                        Unohtuiko salasana?
                    </a>
                </div>
            </form>
        </div>
    </modal>
</login-form>