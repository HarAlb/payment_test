<?php

namespace App\Services\Payment;

use App\Services\Payment\DTO\ConfigDTO;
use App\Services\Payment\Strategies\FirstStrategy\DTO\FirstStrategyDTO;
use App\Services\Payment\Strategies\FirstStrategy\FirstStrategy;
use App\Services\Payment\Strategies\FirstStrategy\Requests\FirstStrategyConfirmationRequest;
use App\Services\Payment\Strategies\SecondStrategy\SecondStrategy;
use App\Services\Payment\Strategies\SecondStrategy\DTO\SecondStrategyDTO;
use App\Services\Payment\Strategies\SecondStrategy\Requests\SecondStrategyConfirmationRequest;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    /**
     * I didnt use try catch
     * @return void
     */
    public function confirm()
    {
        try{
            // TODO: Problem with setting payment service
            // Note! do not send request to one url
            if (strpos(request()->headers->get('Content-Type'), 'application/json') === 0) {
                $request = app(FirstStrategyConfirmationRequest::class);
            } else {
                $request = app(SecondStrategyConfirmationRequest::class);
            }
        }catch (\Exception $exception){
            // так как в конфигурации сервиса платежа было поставлен чтобы все запросы сюда перенаправился,
            // у нас всегда будет грязный код!
            return response()->json([
                'success' => false,
                'errors' => $exception->errors(),
            ], Response::HTTP_FORBIDDEN);
        }

        if ($request::class === FirstStrategyConfirmationRequest::class) {
            $config = new ConfigDTO(
                config('payments.first_strategy_app_id'),
                config('payments.first_strategy_app_key')
            );
            $dto = new FirstStrategyDTO($config, $request);
            $strategy = new FirstStrategy();
        } else {
            $config = new ConfigDTO(
                config('payments.second_strategy_app_id'),
                config('payments.second_strategy_app_key')
            );
            $dto = new SecondStrategyDTO($config, $request);
            $strategy = new SecondStrategy();
        }
        try{
            (new PaymentService($strategy))->confirm($dto);
        } catch (\Exception $exception) {
            // do something
        }

        return response()->json([
            'message' => 'Payment approved'
        ]);
    }
}
