<?php

namespace App\Services;

class UploadManager
{
	public function upload($model, $request ,$location, $attributeName = 'filename')
	{
		$path = $request->file($attributeName)->storeAs(
			$location, 
			$model->slug. '.' . $request->file($attributeName)->getClientOriginalExtension()
		);

		$model->update([$attributeName => $model->slug. '.'. $request->file($attributeName)->getClientOriginalExtension()]);
	}
}