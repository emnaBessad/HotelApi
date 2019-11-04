<?php

namespace Tests\Unit;

use App\Accommodation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccommodationTest extends TestCase
{

    public function test_create_accommodation() {
        $data = [
            "name"=>"Example name",
            "rating"=> 5,
            "category"=> "hotel",
            "city"=> "Cuernavaca",
            "state"=>"Morelos",
            "country"=> "Mexico",
            "zip_code"=> "62448",
            "address"=> "Boulevard Díaz Ordaz No. 9 Cantarranas",
            "image"=> "https://helpx.adobe.com/content/dam/help/en/stock/how-to/visual-reverse-image-search/jcr_content/main-pars/image/visual-reverse-image-search-v2_intro.jpg",
            "reputation"=> 1000,
            "reputationBadge"=> "green",
            "price"=> 1000,
            "availability"=> 10
        ];
        $this->post(route('accommodation.store'), $data)
            ->dump()
            ->assertStatus(201);
    }

    public function test_update_accommodation() {
        $accommodation = factory(Accommodation::class)->create();
        $data = [
            'name' => $this->faker->name,
            'rating' => 3
        ];
        $this->put(route('accommodation.update', $accommodation->id), $data)
            ->dump()
            ->assertStatus(200)
            ->assertJsonFragment($data);
        // invalid case
        $data_error = [
            'name' => $this->faker->name,
            'rating' => 10
        ];
        $this->put(route('accommodation.update', $accommodation->id), $data_error)
            ->dump()
            ->assertStatus(422);
    }

    public function test_show_accommodation() {
        $accommodation = factory(Accommodation::class)->create();
        $this->get(route('accommodation.show',$accommodation->id))
            ->dump()
            ->assertStatus(200)
            ->assertJson($accommodation->toArray());
        // invalid case
        $this->get(route('accommodation.show',11))
            ->dump()
            ->assertStatus(404)
            ->assertJson(['message'=>'Not Found Data','errors'=>['Accommodation'=>'Not Found Accommodation']]);
    }

    public function test_delete_accommodation() {
        $accommodation = factory(Accommodation::class)->create();
        $this->delete(route('accommodation.update', $accommodation->id))
            ->dump()
            ->assertStatus(200)
            ->assertJson(['message'=>'Accommodation has been deleted']);

    }

    public function test_list_accommodations() {
        $accommodations = factory(Accommodation::class, 2)->create();
        $this->get(route('accommodation.index'))
            ->dump()
            ->assertStatus(200)
            ->assertJson([$accommodations->toArray()]);
    }

    public function test_booking_accommodations() {
        $accommodation = factory(Accommodation::class)->create();
        $this->patch(route('booking', $accommodation->id))
            ->dump()
            ->assertStatus(200)
            ->assertJson(['message'=>'Succeeded booking operation']);
        //invalid case
        $this->patch(route('booking', $accommodation->id))
            ->dump()
            ->assertStatus(401)
            ->assertJson(['message'=>'Unavailable Accommodation','errors'=>['Accommodation'=>'Accommodation not available']]);
    }
}
