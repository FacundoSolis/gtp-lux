@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Agregar Nuevo Código de País e Idioma</h1>

    <form action="{{ route('admin.codes.store') }}" method="POST">
        @csrf

        <!-- Selección de País -->
        <div class="mb-3">
            <label for="country_select" class="form-label">Seleccionar País o Agregar Nuevo</label>
            <select id="country_select" name="country_name" class="form-select">
                <option value="" disabled selected>Seleccione un país</option>
                <option value="ES">España</option>
                <option value="US">Estados Unidos</option>
                <option value="GB">Reino Unido</option>
                <option value="FR">Francia</option>
                <option value="DE">Alemania</option>
                <option value="IT">Italia</option>
                <option value="PL">Polonia</option>
                <option value="RU">Rusia</option>
                <option value="NL">Países Bajos</option>
                <option value="UA">Ucrania</option>
                <option value="other">Agregar Nuevo País</option>
            </select>

            <input type="text" id="custom_country" name="custom_country" class="form-control mt-2 d-none" placeholder="Nombre del nuevo país">
        </div>

        <div class="mb-3">
            <label for="country_code" class="form-label">Código de País</label>
            <input type="text" id="country_code" name="country_code" class="form-control" readonly>
        </div>

        <!-- Selección de Idioma -->
        <div class="mb-3">
            <label for="language_select" class="form-label">Seleccionar Idioma o Agregar Nuevo</label>
            <select id="language_select" class="form-select" name="language_name">
                <option value="" disabled selected>Seleccione un idioma</option>
            </select>

            <input type="text" id="custom_language" name="custom_language" class="form-control mt-2 d-none" placeholder="Nombre del nuevo idioma">
        </div>

        <div class="mb-3">
            <label for="language_code" class="form-label">Código de Idioma</label>
            <input type="text" id="language_code" name="language_code" class="form-control">
        </div>

        <div class="mb-3">
            <label for="flag" class="form-label">Bandera</label>
            <input type="text" id="flag" name="flag" class="form-control" placeholder="Ej: tr para Turquía">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const languages = @json(config('languages'));

        const countrySelect = document.getElementById('country_select');
        const languageSelect = document.getElementById('language_select');
        const customCountryInput = document.getElementById('custom_country');
        const customLanguageInput = document.getElementById('custom_language');
        const countryCodeInput = document.getElementById('country_code');
        const languageCodeInput = document.getElementById('language_code');

        const countryToLanguageMap = {
            ES: ['es'],
            US: ['en', 'en_us'],
            GB: ['gb'],
            FR: ['fr'],
            DE: ['de'],
            IT: ['it'],
            PL: ['pl'],
            RU: ['ru'],
            NL: ['nl'],
            UA: ['uk'],
        };

        // Cambiar país
        countrySelect.addEventListener('change', () => {
            const selectedCountry = countrySelect.value;

            if (selectedCountry === 'other') {
                customCountryInput.classList.remove('d-none');
                countryCodeInput.readOnly = false;
                countryCodeInput.value = '';
            } else {
                customCountryInput.classList.add('d-none');
                countryCodeInput.readOnly = true;
                countryCodeInput.value = selectedCountry;
                updateLanguages(selectedCountry);
            }
        });

        // Cambiar idioma
        languageSelect.addEventListener('change', () => {
            const selectedLang = languageSelect.value;

            if (selectedLang === 'other') {
                customLanguageInput.classList.remove('d-none');
                languageCodeInput.readOnly = false;
                languageCodeInput.value = '';
            } else {
                customLanguageInput.classList.add('d-none');
                languageCodeInput.readOnly = true;
                languageCodeInput.value = selectedLang;
            }
        });

        function updateLanguages(country) {
            languageSelect.innerHTML = '<option value="" disabled selected>Seleccione un idioma</option>';
            const languagesForCountry = countryToLanguageMap[country];
            if (languagesForCountry) {
                languagesForCountry.forEach(langCode => {
                    const langData = languages[langCode];
                    if (langData) {
                        const option = document.createElement('option');
                        option.value = langCode;
                        option.textContent = `${langData.name} (${langCode.toUpperCase()})`;
                        languageSelect.appendChild(option);
                    }
                });
                languageSelect.innerHTML += '<option value="other">Agregar Nuevo Idioma</option>';
            }
        }
    });
</script>
@endsection
