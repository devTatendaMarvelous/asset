class ClockResponse {
  final String status;
  final String message;
  final Map<String, dynamic>? data;

  ClockResponse({
    required this.status,
    required this.message,
    this.data,
  });

  bool get success => status.toLowerCase() == 'success';

  factory ClockResponse.fromJson(Map<String, dynamic> json) {
    return ClockResponse(
      status: json['status'] ?? '',
      message: json['message'] ?? '',
      data: json['data'],
    );
  }
}