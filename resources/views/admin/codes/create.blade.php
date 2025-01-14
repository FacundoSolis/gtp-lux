@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Agregar Nuevo Código de País e Idioma</h1>

    <form action="{{ route('admin.codes.store') }}" method="POST">
        @csrf

        <!-- Selección de País -->
        <div class="mb-3">
            <label for="country_select" class="form-label">Seleccionar País</label>
            <select id="country_select" class="form-select">
                <option value="" disabled selected>Seleccione un país</option>
                <option value="ES">España</option>
                <option value="US">Estados Unidos</option>
                <option value="FR">Francia</option>
                <option value="DE">Alemania</option>
                <option value="IT">Italia</option>
                <option value="PL">Polonia</option>
                <option value="RU">Rusia</option>
                <option value="NL">Países Bajos</option>
                <option value="UA">Ucrania</option>
            </select>
        </div>

        <!-- Campos Automáticos -->
        <div class="mb-3">
            <label for="country_name" class="form-label">Nombre del País</label>
            <input type="text" id="country_name" name="country_name" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="country_code" class="form-label">Código de País</label>
            <input type="text" id="country_code" name="country_code" class="form-control" readonly>
        </div>

        <!-- Selección de Idioma -->
        <div class="mb-3">
            <label for="language_select" class="form-label">Seleccionar Idioma</label>
            <select id="language_select" class="form-select">
                <option value="" disabled selected>Seleccione un idioma</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="language_name" class="form-label">Nombre del Idioma</label>
            <input type="text" id="language_name" name="language_name" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="language_code" class="form-label">Código de Idioma</label>
            <input type="text" id="language_code" name="language_code" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="flag" class="form-label">Language</label>
            <input type="text" id="flag" name="flag" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Datos precargados
        const languages = @json(config('languages'));

        // Elementos del DOM
        const countrySelect = document.getElementById('country_select');
        const languageSelect = document.getElementById('language_select');
        const countryName = document.getElementById('country_name');
        const countryCode = document.getElementById('country_code');
        const languageName = document.getElementById('language_name');
        const languageCode = document.getElementById('language_code');
        const flag = document.getElementById('flag');

        // Mapeo de Países a Idiomas
        const countryToLanguageMap = {
            ES: ['es'],
            US: ['en', 'en_us'],
            FR: ['fr'],
            DE: ['de'],
            IT: ['it'],
            PL: ['pl'],
            RU: ['ru'],
            NL: ['nl'],
            UA: ['uk'],
        };

        // Cambiar País
        countrySelect.addEventListener('change', () => {
            const selectedCountry = countrySelect.value;

            // Rellenar Nombre y Código del País
            countryName.value = countrySelect.options[countrySelect.selectedIndex].text;
            countryCode.value = selectedCountry;

            // Actualizar Idiomas Disponibles
            languageSelect.innerHTML = '<option value="" disabled selected>Seleccione un idioma</option>';
            const languagesForCountry = countryToLanguageMap[selectedCountry];
            if (languagesForCountry) {
                languagesForCountry.forEach(langCode => {
                    const langData = languages[langCode];
                    if (langData) {
                        const option = document.createElement('option');
                        option.value = langCode;
                        option.textContent = `${langData.name} (${langCode.toUpperCase()})`;
                        option.dataset.flag = langData.flag;
                        languageSelect.appendChild(option);
                    }
                });
            }
        });

        // Cambiar Idioma
        languageSelect.addEventListener('change', () => {
            const selectedLang = languageSelect.value;
            const langData = languages[selectedLang];
            if (langData) {
                languageName.value = langData.name;
                languageCode.value = selectedLang;
                flag.value = langData.flag;
            }
        });
    });
</script>
@endsection
