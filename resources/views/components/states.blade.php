<select class="form-select" name="state"
    @if (!empty($tabindex)) tabindex="{{ $tabindex }}" @endif {{ !empty($required) ? 'required' : '' }}>
    <option>Select State</option>
    <option value="AL"{{ $selected === 'AL' ? ' selected' : '' }}>Alabama</option>
    <option value="AK"{{ $selected === 'AK' ? ' selected' : '' }}>Alaska</option>
    <option value="AZ"{{ $selected === 'AZ' ? ' selected' : '' }}>Arizona</option>
    <option value="AR"{{ $selected === 'AR' ? ' selected' : '' }}>Arkansas</option>
    <option value="CA"{{ $selected === 'CA' ? ' selected' : '' }}>California</option>
    <option value="CO"{{ $selected === 'CO' ? ' selected' : '' }}>Colorado</option>
    <option value="CT"{{ $selected === 'CT' ? ' selected' : '' }}>Connecticut</option>
    <option value="DE"{{ $selected === 'DE' ? ' selected' : '' }}>Delaware</option>
    <option value="DC"{{ $selected === 'DC' ? ' selected' : '' }}>District Of Columbia</option>
    <option value="FL"{{ $selected === 'FL' ? ' selected' : '' }}>Florida</option>
    <option value="GA"{{ $selected === 'GA' ? ' selected' : '' }}>Georgia</option>
    <option value="HI"{{ $selected === 'HI' ? ' selected' : '' }}>Hawaii</option>
    <option value="ID"{{ $selected === 'ID' ? ' selected' : '' }}>Idaho</option>
    <option value="IL"{{ $selected === 'IL' ? ' selected' : '' }}>Illinois</option>
    <option value="IN"{{ $selected === 'IN' ? ' selected' : '' }}>Indiana</option>
    <option value="IA"{{ $selected === 'IA' ? ' selected' : '' }}>Iowa</option>
    <option value="KS"{{ $selected === 'KS' ? ' selected' : '' }}>Kansas</option>
    <option value="KY"{{ $selected === 'KY' ? ' selected' : '' }}>Kentucky</option>
    <option value="LA"{{ $selected === 'LA' ? ' selected' : '' }}>Louisiana</option>
    <option value="ME"{{ $selected === 'ME' ? ' selected' : '' }}>Maine</option>
    <option value="MD"{{ $selected === 'MD' ? ' selected' : '' }}>Maryland</option>
    <option value="MA"{{ $selected === 'MA' ? ' selected' : '' }}>Massachusetts</option>
    <option value="MI"{{ $selected === 'MI' ? ' selected' : '' }}>Michigan</option>
    <option value="MN"{{ $selected === 'MN' ? ' selected' : '' }}>Minnesota</option>
    <option value="MS"{{ $selected === 'MS' ? ' selected' : '' }}>Mississippi</option>
    <option value="MO"{{ $selected === 'MO' ? ' selected' : '' }}>Missouri</option>
    <option value="MT"{{ $selected === 'MT' ? ' selected' : '' }}>Montana</option>
    <option value="NE"{{ $selected === 'NE' ? ' selected' : '' }}>Nebraska</option>
    <option value="NV"{{ $selected === 'NV' ? ' selected' : '' }}>Nevada</option>
    <option value="NH"{{ $selected === 'NH' ? ' selected' : '' }}>New Hampshire</option>
    <option value="NJ"{{ $selected === 'NJ' ? ' selected' : '' }}>New Jersey</option>
    <option value="NM"{{ $selected === 'NM' ? ' selected' : '' }}>New Mexico</option>
    <option value="NY"{{ $selected === 'NY' ? ' selected' : '' }}>New York</option>
    <option value="NC"{{ $selected === 'NC' ? ' selected' : '' }}>North Carolina</option>
    <option value="ND"{{ $selected === 'ND' ? ' selected' : '' }}>North Dakota</option>
    <option value="OH"{{ $selected === 'OH' ? ' selected' : '' }}>Ohio</option>
    <option value="OK"{{ $selected === 'OK' ? ' selected' : '' }}>Oklahoma</option>
    <option value="OR"{{ $selected === 'OR' ? ' selected' : '' }}>Oregon</option>
    <option value="PA"{{ $selected === 'PA' ? ' selected' : '' }}>Pennsylvania</option>
    <option value="RI"{{ $selected === 'RI' ? ' selected' : '' }}>Rhode Island</option>
    <option value="SC"{{ $selected === 'SC' ? ' selected' : '' }}>South Carolina</option>
    <option value="SD"{{ $selected === 'SC' ? ' selected' : '' }}>South Dakota</option>
    <option value="TN"{{ $selected === 'TN' ? ' selected' : '' }}>Tennessee</option>
    <option value="TX"{{ $selected === 'TX' ? ' selected' : '' }}>Texas</option>
    <option value="UT"{{ $selected === 'UT' ? ' selected' : '' }}>Utah</option>
    <option value="VT"{{ $selected === 'VT' ? ' selected' : '' }}>Vermont</option>
    <option value="VA"{{ $selected === 'VA' ? ' selected' : '' }}>Virginia</option>
    <option value="WA"{{ $selected === 'WA' ? ' selected' : '' }}>Washington</option>
    <option value="WV"{{ $selected === 'WV' ? ' selected' : '' }}>West Virginia</option>
    <option value="WI"{{ $selected === 'WE' ? ' selected' : '' }}>Wisconsin</option>
    <option value="WY"{{ $selected === 'WY' ? ' selected' : '' }}>Wyoming</option>
    <option value="AS"{{ $selected === 'AS' ? ' selected' : '' }}>American Samoa</option>
    <option value="GU"{{ $selected === 'GU' ? ' selected' : '' }}>Guam</option>
    <option value="MP"{{ $selected === 'MP' ? ' selected' : '' }}>Northern Mariana Islands</option>
    <option value="PR"{{ $selected === 'PR' ? ' selected' : '' }}>Puerto Rico</option>
    <option value="UM"{{ $selected === 'UM' ? ' selected' : '' }}>United States Minor Outlying Islands</option>
    <option value="VI"{{ $selected === 'VI' ? ' selected' : '' }}>Virgin Islands</option>
</select>
