let getProvince = () => {
    $.ajax({
        url: 'http://api.rajaongkir.com/starter/province',
        method: 'GET',
        type: 'json',
        data: {
            'key': '85fad8953db6714f6d0b407c76554424'
        },
        success: function (data) {
            let province = data.rajaongkir.results;
            $.each(province, function (i, item) {
                $('.provinsi').append("<option value='" + item.province_id + "'>" + item.province + "</option>");
            });
        },
    });
}

let getCity = (province_id) => {
    $.ajax({
        url: 'http://api.rajaongkir.com/starter/city',
        method: 'GET',
        type: 'json',
        delay: 100,
        data: {
            'key': '85fad8953db6714f6d0b407c76554424',
            'province': province_id,
        },
        success: function (data) {
            let city = data.rajaongkir.results;
            $.each(city, function (i, item) {
                let nama = item.type + " " + item.city_name;
                $('.city').append("<option value='" + item.city_id + "'>" + nama + "</option>");
            });
        },
    });

}

let getCityById = (province_id, city_id) => {
    $.ajax({
        url: 'http://api.rajaongkir.com/starter/city',
        method: 'GET',
        type: 'json',
        data: {
            'key': '85fad8953db6714f6d0b407c76554424',
            'province': province_id,
            'id': city_id
        },
        success: function (data) {
            let city = data.rajaongkir.results;
            let nama = city.type + " " + city.city_name;

            $('.provinsi_text').html("Provinsi " + city.province);
            $('.city_text').html(nama);

            let option1 = new Option(city.province, city.province_id);
            option1.selected = true;

            let option2 = new Option(city.city_name, city.city_id);
            option2.selected = true;

            $(".provinsi").append(option1);
            $(".city").append(option2);
        },
    });
}
