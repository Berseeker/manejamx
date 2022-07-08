<?php

namespace Tests\Feature\Admin\Affiliate;

use App\Models\Affiliate;
use App\Models\AffiliateLevel;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AffiliateTest extends TestCase
{
    use RefreshDatabase;

    function test_list_affiliates()
    {
        $this->signIn();

        $affiliate = Affiliate::factory()->create();

        $this->get('api/admin/affiliates')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    0   => [
                        'id'        => $affiliate->id,
                        'files'     => [],
                        'status'    => []
                    ]
                ]
            ]);
    }

    function test_approve_an_affiliate()
    {
        $user = $this->signIn();

        $affiliate = Affiliate::factory()->create();
        $status = Status::factory()->create(['id' => Status::APPROVED]);
        $role = Role::factory()->create(['id' => Role::AFFILIATE]);

        $level = AffiliateLevel::factory()->create(['start_points' => 0]);

        $this->post('api/admin/affiliates/'.$affiliate->id.'/approbations')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id'    => $affiliate->id,
                ]
            ]);

        $this->assertDatabaseHas('affiliates', [
            'id'            => $affiliate->id,
            'approved_at'   => now()->format('Y-m-d H:i'),
            'approved_by'   => $user->id,
            'status_id'     => $status->id,
            'level_id'      => $level->id,
        ]);

        $this->assertDatabaseHas('users', [
            'name'          => $affiliate->name.' '.$affiliate->last_name,
            'email'         => $affiliate->email,
            'phone'         => $affiliate->phone,
            'affiliate_id'  => $affiliate->id,
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'model_id'      => User::query()->max('id'),
            'model_type'    => User::class,
            'role_id'       => $role->id,
        ]);
    }

    function test_reject_an_affiliate()
    {
        $user = $this->signIn();

        $affiliate = Affiliate::factory()->create();
        $status = Status::factory()->create(['id' => Status::REJECTED]);

        $this->post('api/admin/affiliates/'.$affiliate->id.'/rejections')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id'    => $affiliate->id,
                ]
            ]);

        $this->assertDatabaseHas('affiliates', [
            'id'            => $affiliate->id,
            'rejected_at'   => now()->format('Y-m-d H:i'),
            'rejected_by'   => $user->id,
            'status_id'     => $status->id,
        ]);
    }
}
