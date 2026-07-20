import json

with open(r"d:\project_ziky\Monitoring_bila\monitoringsuply-bila-log-export-2026-07-20T11-53-06.json", "r", encoding="utf-8") as f:
    data = json.load(f)

with open(r"d:\project_ziky\Monitoring_bila\scratch\parsed_logs.txt", "w", encoding="utf-8") as out:
    for i, log in enumerate(data):
        msg = log.get("message", "")
        if msg:
            out.write(f"--- LOG {i} ({log.get('TimeUTC')}) ---\n")
            out.write(msg + "\n")
            out.write("\n" + "="*50 + "\n\n")
